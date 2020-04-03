<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class AppController extends AbstractController
{
    /**
     * @Route("/ok")
     */
    public function ok()
    {
        return new Response('ok');
    }

    /**
     * @Route("/not")
     */
    public function not(CacheInterface $cache)
    {
        $value = $cache->get('test_key', function (CacheItemInterface $item) {
            $item->expiresAfter(5 * 60);

            return 'value_1';
        }, INF);

        return new Response('not_ok'.$value);
    }
}