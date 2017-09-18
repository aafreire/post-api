<?php

namespace just\Transformer;

use League\Fractal\TransformerAbstract;
use just\Models\Post;

class PostTransformer extends TransformerAbstract
{
	/**
	* @param Post $post
	* @return array
	**/
	public function transform(Post $post)
	{
		return [
			'id'    => $post->getId(),
			'title' => $post->getTitle(),
			'body'  => $post->getBody(),
			'path'  => $post->getPath()
		];
	}
}