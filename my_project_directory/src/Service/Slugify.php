<?php

namespace App\Service;
use Symfony\Component\String\Slugger\AsciiSlugger;

class Slugify
{
    public function generateSlug(string $texte) :string {

        $slugger = new AsciiSlugger();
        return $slugger->slug($texte);
    }
}