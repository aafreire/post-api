<?php

use Psr\Http\Message\ServerRequestInterface;
use just\Models\Post;
use just\Transformer\PostTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Doctrine\ORM\NoResultException;

$app
    ->get('/post', function() use($app, $entityManager){
        $posts = $entityManager->getRepository('just\Models\Post')->findAll();

        $fractal = new Manager();
        $resource = new Collection($posts, new PostTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    })

    ->get('/post/{id}', function(ServerRequestInterface $request) use($app, $entityManager){
        $id = $request->getAttribute('id');

        $post = $entityManager->getRepository('just\Models\Post')->find($id);

        if (empty($post)){
            throw new NoResultException;
        }

        $fractal = new Manager();
        $resource = new Item($post, new PostTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    })

    ->post('/post', function(ServerRequestInterface $request) use($app, $entityManager){
        $data = json_decode($request->getBody()->getContents());

        $post = new Post();

        if (!preg_match('%^/(?!.*\/$)(?!.*[\/]{2,})(?!.*\?.*\?)(?!.*\.\/).*%im', $data->path)) {
            throw new \InvalidArgumentException("invalide path");
        }

        $post->setTitle($data->title);
        $post->setBody($data->body);
        $post->setPath($data->path);

        try {
            $entityManager->persist($post);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            echo "string";die;
        }

        $fractal = new Manager();
        $resource = new Item($post, new PostTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    })

    ->put('/post/{id}', function(ServerRequestInterface $request) use($app, $entityManager){
        $data = json_decode($request->getBody()->getContents());

        $id = $request->getAttribute('id');

        $post = $entityManager->getRepository('just\Models\Post')->find($id);

        $post->setTitle($data->title);
        $post->setBody($data->body);
        $post->setPath($data->path);

        $entityManager->persist($post);
        $entityManager->flush();

        $fractal = new Manager();
        $resource = new Item($post, new PostTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    })

    ->delete('/post/{id}', function(ServerRequestInterface $request) use($app){
        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write("delete para /post{id}");
        return $response;
    })

    ->getAll('{path}', function(ServerRequestInterface $request) use($app, $entityManager){
        $path = $request->getAttribute('path');

        $post = $entityManager->getRepository('just\Models\Post')->findByPath($path);
        $fractal = new Manager();
        $resource = new Item($post, new PostTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    });