<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $article = new Article();
        $article->setTitle("An A.I. Pioneer Wants an FDA for Facial Recognition");
        $article->setAutor("Dave Gershgorn");
        $article->setDescription("Erik Learned-Miller helped create one of the most important face datasets in the world. Now he wants to regulate his creation.");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-24"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Do You Really Need Another Computer Monitor?");
        $article->setAutor("Angela Lashbrook");
        $article->setDescription("Short answer? Yes. Yes, you do.");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-24"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Why Machine Learning Models Degrade In Production");
        $article->setAutor("Alexandre Gonfalonieri");
        $article->setDescription("After several failed ML projects due to unexpected ML degradation, I wanted to share my experience in ML models degradation. Indeed, there…");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-24"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Problematic Smartphone Use: Addiction or Compulsion?");
        $article->setAutor("Robert Roy Britt");
        $article->setDescription("Opinions are strong, but the science is far from settled");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-23"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("What Will Kill Podcasting?");
        $article->setAutor("Tom Webster");
        $article->setDescription("It’s probably not what you think");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-19"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("Facebook Is Inviting Washington to Regulate Libra — Good Luck With That");
        $article->setAutor("Eric Ravenscraft");
        $article->setDescription("Is it a bank? Is it anonymous? Is it an investment? The questions are unending.");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-26"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("This is How to Train Your Daimon and Realize Your True Potential");
        $article->setAutor("David Paul Kirkpatrick");
        $article->setDescription("How to handle the dangerous tensions that come with being a highly creative person");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-11"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("How To Make Money Writing on Medium");
        $article->setAutor("Tim Denning");
        $article->setDescription("Have the right attitude, focus on mastery, and be patient");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-24"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("How To Never Run Out of Ideas, Stay Creative, and Become Prolific");
        $article->setAutor("Ayodeji Awosika");
        $article->setDescription("Use the idea machine technique and make sure you both consume and create");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-23"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("They Said Engineers Don’t Give Birth to Artists. They Were Wrong.");
        $article->setAutor("Margarita Gokun Silver");
        $article->setDescription("Becoming your own person is never a frivolity");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-20"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("How To Quickly Grow Your Email List in 3 Simple Steps");
        $article->setAutor("Mahmud Ahmed");
        $article->setDescription("Solve a problem, deliver the solution, and hold your readers’ hands along the way");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-25"));

        $manager->persist($article);

        $article = new Article();
        $article->setTitle("How to Improve Communication Frequency With Your Remote Team");
        $article->setAutor("Vy Luu");
        $article->setDescription("Leaders should use this one metric to improve the morale of geographically distributed teams");
        $article->setModification(\DateTime::createFromFormat('Y-m-d', "2019-07-24"));

        $manager->persist($article);

        $manager->flush();

        $manager->flush();
    }
}
