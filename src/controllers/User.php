<?php

use Psr\Http\Message\ServerRequestInterface;
use just\Models\User;
use just\Transformer\UserTokenTransformer;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Lcobucci\JWT\Builder;

$app
    ->post('/login', function(ServerRequestInterface $request) use($app, $entityManager){
        $data = json_decode($request->getBody()->getContents());

        $login = $entityManager->getRepository('just\Models\User')->validateUser($data);

	    if (!$login) {
			throw new \InvalidArgumentException("Authentication failed");
	    }

        $token = (new Builder())->setIssuer('Post API')
	      ->setAudience('Post API')
	      ->setIssuedAt(time())
	      ->setExpiration(time() + 7800)
	      ->getToken();

        $fractal = new Manager();
        $resource = new Item($token, new UserTokenTransformer);

        $response = new \Zend\Diactoros\Response();
        $response->getBody()->write($fractal->createData($resource)->toJson());
        return $response;
    });
