<?php
/*
 * Copyright (c) 2014 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * This file is part of PHPMentors_Example_Symfony.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace Example\CampaignBundle\Entity;

use PHPMentors\DomainKata\Entity\EntityCollectionInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;

class CampaignCollection implements EntityCollectionInterface
{
    /**
     * @var Campaign[]
     */
    private $campaigns;

    /**
     * @param Campaign[] $campaigns
     */
    public function __construct(array $campaigns = array())
    {
        $this->campaigns = $campaigns;
    }

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
    public function count()
    {
        return count($this->campaigns);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->campaigns);
    }
}
