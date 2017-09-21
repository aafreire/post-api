<?php

namespace just\Transformer;

use League\Fractal\TransformerAbstract;
use Lcobucci\JWT\Token;

class UserTokenTransformer extends TransformerAbstract
{
	/**
	* @param Token $token
	* @return array
	**/
	public function transform(Token $token)
	{
		return [
			'token'  => (string) $token
		];
	}
}