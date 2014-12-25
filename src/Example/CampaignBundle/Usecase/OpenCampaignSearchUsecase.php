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

namespace Example\CampaignBundle\Usecase;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\QueryUsecaseInterface;

use Example\CampaignBundle\Domain\Data\CampaignCollection;
use Example\CampaignBundle\Domain\Data\Repository\CampaignRepository;

class OpenCampaignSearchUsecase implements QueryUsecaseInterface
{
    /**
     * @var CampaignRepository
     */
    private $campaignRepository;

    /**
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * {@inheritDoc}
     *
     * @return CampaignCollection
     */
    public function run(EntityInterface $entity = null)
    {
        if ($entity instanceof CriteriaInterface) {
            $campaigns = $this->campaignRepository->queryByCriteria($entity);
        } else {
            $campaigns = $this->campaignRepository->findAll();
        }

        return $campaigns;
    }
}
