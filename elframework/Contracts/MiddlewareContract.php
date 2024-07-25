<?php 
namespace Contracts;

interface MiddlewareContract 
{
    public function handle($request,$next);
}