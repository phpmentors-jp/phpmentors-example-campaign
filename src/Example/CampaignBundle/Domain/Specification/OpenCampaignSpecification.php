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

namespace Example\CampaignBundle\Domain\Specification;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use PHPMentors\DomainKata\Specification\SpecificationInterface;

use Example\CampaignBundle\Domain\Data\Criteria;
use Example\CampaignBundle\Util\Clock;

class OpenCampaignSpecification implements SpecificationInterface, CriteriaBuilderInterface
{
    /**
     * @var Clock
     */
    protected $clock;

    /**
     * @param Clock $clock
     */
    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy(EntityInterface $entity)
    {
        if (
            ($entity->getStartDate() <= $this->clock->getCurrentDateTime()) &&
            ($entity->getEndDate() > $this->clock->getCurrentDateTime())
        ) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $criteria = new Criteria();
        $criteria->where($criteria->expr()->andX(
            $criteria->expr()->lte('startDate', $this->clock->getCurrentDateTime()),
            $criteria->expr()->gt('endDate', $this->clock->getCurrentDateTime())
        ));

        return $criteria;
    }
}
