<?php
/*
 * Copyright (c) 2013 GOTO Hidenori <hidenorigoto@gmail.com>,
 *               2014 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * This file is part of PHPMentors_Example_Symfony.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace Example\CampaignBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use PHPMentors\DomainKata\Repository\Operation\QueryableInterface;
use PHPMentors\DomainKata\Repository\RepositoryInterface;

use Example\CampaignBundle\Domain\Data\CampaignCollection;

class CampaignRepository extends EntityRepository implements RepositoryInterface, QueryableInterface
{
    /**
     * {@inheritDoc}
     */
    public function add(EntityInterface $entity)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function remove(EntityInterface $entity)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function queryByCriteria(CriteriaInterface $criteria)
    {
        if ($criteria instanceof CriteriaBuilderInterface) {
            $criteria = $criteria->build();
        }

        return new CampaignCollection($this->matching($criteria)->toArray());
    }
}
