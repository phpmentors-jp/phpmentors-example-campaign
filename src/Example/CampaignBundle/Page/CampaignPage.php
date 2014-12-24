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

namespace Example\CampaignBundle\Page;

use Example\CampaignBundle\Domain\Data\CampaignCollection;
use Example\CampaignBundle\Domain\Specification\OpenCampaignSpecification;
use Example\CampaignBundle\Domain\Usecase\OpenCampaignSearchUsecase;

class CampaignPage extends AppPage
{
    /**
     * @var OpenCampaignSpecification
     */
    protected $openCampaignSpec;

    /**
     * @var CampaignCollection
     */
    protected $campaignList;

    /**
     * @var OpenCampaignSearchUsecase
     */
    protected $openCampaignSearchUsecase;

    /**
     * @param OpenCampaignSpecification $openCampaignSpec
     * @param OpenCampaignSearchUsecase $openCampaignSearchUsecase
     */
    public function __construct(OpenCampaignSpecification $openCampaignSpec, OpenCampaignSearchUsecase $openCampaignSearchUsecase)
    {
        $this->openCampaignSpec = $openCampaignSpec;
        $this->openCampaignSearchUsecase = $openCampaignSearchUsecase;
    }

    public function index()
    {
        $this->campaignList = $this->openCampaignSearchUsecase->run($this->openCampaignSpec);
    }

    public function all()
    {
        $this->campaignList = $this->openCampaignSearchUsecase->run();
    }

    /**
     * @param  \DateTime $date
     * @return string
     */
    public function dateFormat(\DateTime $date)
    {
        return $date->format('n月j日');
    }

    /**
     * @return CampaignCollection
     */
    public function getCampaignList()
    {
        return $this->campaignList;
    }

    /**
     * @return OpenCampaignSpecification
     */
    public function getOpenCampaignSpec()
    {
        return $this->openCampaignSpec;
    }
}
