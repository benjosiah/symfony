<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\PostType;

class PostsController extends AbstractController
{
   
    public function addPost(Request $request)
    {
        $post= new Post();
        $form=$this->createForm(PostType::class, $post);
        $form->handleRequest();
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            
        }
    }
}
