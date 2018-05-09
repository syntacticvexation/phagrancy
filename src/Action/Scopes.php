<?php

/**
 * @file
 * Contains Phagrancy\Action\Scopes
 */

namespace Phagrancy\Action;

use Phagrancy\Http\Response;
use Phagrancy\Model\Input;
use Phagrancy\Model\Repository;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action for listing the boxes in a given scope
 *
 * @package Phagrancy\Action
 */
class Scopes
{
	/**
	 * @var Repository\Scope
	 */
	private $repository;

	/**
	 * @var Input\Scope
	 */
	private $validator;

	public function __construct(Repository\Scope $repository, Input\Scope $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function __invoke(ServerRequestInterface $request)
	{
		$params = $this->validator->validate($request->getAttribute('route')->getArguments());
		$scopes   = $this->repository->all();

		return new Response\ScopeList($scopes);
	}
}
