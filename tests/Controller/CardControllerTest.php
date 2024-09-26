<?php

namespace App\Tests\Controller;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CardControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/card/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Card::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Card index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'card[title]' => 'Testing',
            'card[card_type]' => 'Testing',
            'card[card_action]' => 'Testing',
            'card[description]' => 'Testing',
            'card[level]' => 'Testing',
            'card[level_reward]' => 'Testing',
            'card[treasure_reward]' => 'Testing',
            'card[lose_description]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Card();
        $fixture->setTitle('My Title');
        $fixture->setCard_type('My Title');
        $fixture->setCard_action('My Title');
        $fixture->setDescription('My Title');
        $fixture->setLevel('My Title');
        $fixture->setLevel_reward('My Title');
        $fixture->setTreasure_reward('My Title');
        $fixture->setLose_description('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Card');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Card();
        $fixture->setTitle('Value');
        $fixture->setCard_type('Value');
        $fixture->setCard_action('Value');
        $fixture->setDescription('Value');
        $fixture->setLevel('Value');
        $fixture->setLevel_reward('Value');
        $fixture->setTreasure_reward('Value');
        $fixture->setLose_description('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'card[title]' => 'Something New',
            'card[card_type]' => 'Something New',
            'card[card_action]' => 'Something New',
            'card[description]' => 'Something New',
            'card[level]' => 'Something New',
            'card[level_reward]' => 'Something New',
            'card[treasure_reward]' => 'Something New',
            'card[lose_description]' => 'Something New',
        ]);

        self::assertResponseRedirects('/card/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getCard_type());
        self::assertSame('Something New', $fixture[0]->getCard_action());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getLevel());
        self::assertSame('Something New', $fixture[0]->getLevel_reward());
        self::assertSame('Something New', $fixture[0]->getTreasure_reward());
        self::assertSame('Something New', $fixture[0]->getLose_description());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Card();
        $fixture->setTitle('Value');
        $fixture->setCard_type('Value');
        $fixture->setCard_action('Value');
        $fixture->setDescription('Value');
        $fixture->setLevel('Value');
        $fixture->setLevel_reward('Value');
        $fixture->setTreasure_reward('Value');
        $fixture->setLose_description('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/card/');
        self::assertSame(0, $this->repository->count([]));
    }
}
