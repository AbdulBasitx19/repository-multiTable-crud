<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;

use App\Repositories\PostRepository;
use App\Repositories\CommentRepository;
use App\Repositories\TagRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            PostRepositoryInterface::class,      
            PostRepository::class              
        );

        // Comment Repository Binding
        $this->app->bind(
            CommentRepositoryInterface::class,   
            CommentRepository::class             
        );

        // Tag Repository Binding
        $this->app->bind(
            TagRepositoryInterface::class,       
            TagRepository::class                 
        );
    }


    public function boot(): void
    {
        //
    }
}