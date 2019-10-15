<?php

declare(strict_types=1);

namespace Setono\SyliusBulkSpecialsPlugin\Handler;

use Doctrine\Common\Persistence\Mapping\MappingException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Enqueue\Client\ProducerInterface;
use Enqueue\Client\TopicSubscriberInterface;
use Interop\Queue\PsrContext;
use Interop\Queue\PsrMessage;
use Interop\Queue\PsrProcessor;
use Setono\SyliusBulkSpecialsPlugin\Model\ProductInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;

class EligibleSpecialsReassignAsyncHandler extends AbstractProductHandler implements EligibleSpecialsReassignHandlerInterface, PsrProcessor, TopicSubscriberInterface
{
    public const EVENT = 'setono_sylius_bulk_specials_topic_reassign_specials';

    /** @var ProducerInterface */
    protected $producer;

    /** @var ProductRepository */
    protected $repository;

    /** @var EligibleSpecialsReassignHandler */
    protected $eligibleSpecialsReassignHandler;

    /**
     * Required for cleanup
     *
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(
        ProducerInterface $producer,
        ProductRepository $repository,
        EligibleSpecialsReassignHandler $eligibleSpecialsReassignHandler,
        EntityManager $entityManager
    ) {
        parent::__construct();

        $this->producer = $producer;
        $this->repository = $repository;
        $this->eligibleSpecialsReassignHandler = $eligibleSpecialsReassignHandler;
        $this->entityManager = $entityManager;
    }

    public function handleProduct(ProductInterface $product): void
    {
        $this->producer->sendEvent(
            self::EVENT,
            $product->getId()
        );
    }

    /**
     * @throws MappingException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function process(PsrMessage $message, PsrContext $session): string
    {
        /** @var ProductInterface|null $product */
        $product = $this->repository->find(
            $message->getBody()
        );

        if (!$product instanceof ProductInterface) {
            return self::REJECT;
        }

        $this->eligibleSpecialsReassignHandler->handle($product);

        $this->entityManager->flush();
        $this->entityManager->clear();

        return self::ACK;
    }

    public static function getSubscribedTopics()
    {
        return [
            self::EVENT,
        ];
    }
}
