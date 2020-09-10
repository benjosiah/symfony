<?php

namespace App\Controller;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PostType;
class PagesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $post= new Post();
        $form=$this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $post->setDate(new \DateTime());
            $post->setUserId(1);
            $em->persist($post);
            $em->flush();            
        }
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'PagesController',
            'form'=>$form->createView()
        ]);
    }
       /**
     * @Route("/posts", name="post")
     */
    public function posts()
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
       $posts= $repository->findAll();
        return $this->render('pages/post.html.twig', [
            'controller_name' => 'PagesController', 
            'posts'=>$posts
            
        ]);
    }
     /**
     * @Route("/post/{id}", name="pos")
     */
    public function post($id)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
       $post= $repository->find($id);
        return $this->render('pages/spost.html.twig', [
            'controller_name' => 'PagesController', 
            'post'=>$post
            
        ]);
    }
    /**
     * @Route("/delte/{id}", name="delete")
     */
     public function delete($id)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $posts= $repository->findAll();
        $post= $repository->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->render('pages/post.html.twig', [
            'controller_name' => 'PagesController', 
            'posts'=>$posts
            
        ]);
    }

}
