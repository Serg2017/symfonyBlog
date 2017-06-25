<?php
namespace BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Blog;

class DefaultArticleData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $blog = new Blog();
        $blog->setTitle('TitleTest 10101010101010101010101');
        $blog->setBody('<p>LoremIpsum testLorem text testLorem hello blog test</p>');
        $blog->setSummary('Lorem ipsum summary');

        $manager->persist($blog);
        $manager->flush();
    }
}