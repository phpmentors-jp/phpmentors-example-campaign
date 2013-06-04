<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5.3
 *
 * Copyright (c) 2013 GOTO Hidenori <hidenorigoto@gmail.com>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPMentors_Example_Symfony
 * @copyright  2013 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      File available since Release 1.0.0
 */

namespace Example\CampaignBundle\Page;

use Doctrine\Common\Collections\ArrayCollection;
use Example\CampaignBundle\Domain\Data\Repository\CampaignRepository;
use Example\CampaignBundle\Domain\Specification\OpenCampaignSpecification;

/**
 * @package    PHPMentors_Example_Symfony
 * @copyright  2013 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      Class available since Release 1.0.0
 */
class CampaignPage extends AppPage
{
    /**
     * @var OpenCampaignSpecification
     */
    protected $openCampaignSpec;

    /**
     * @var CampaignRepository
     */
    protected $campaignRepository;

    /**
     * @var ArrayCollection
     */
    protected $campaignList;

    public function __construct(OpenCampaignSpecification $openCampaignSpec, CampaignRepository $campaignRepository)
    {
        $this->openCampaignSpec = $openCampaignSpec;
        $this->campaignRepository = $campaignRepository;
    }

    public function index()
    {
        $this->campaignList = $this->campaignRepository->selectSatisfying($this->openCampaignSpec);
    }

    public function all()
    {
        $this->campaignList = $this->campaignRepository->findAll();
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function dateFormat(\DateTime $date)
    {
        return $date->format('n月j日');
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCampaignList()
    {
        return $this->campaignList;
    }

    /**
     * @return \Example\CampaignBundle\Domain\Data\Repository\CampaignRepository
     */
    public function getCampaignRepository()
    {
        return $this->campaignRepository;
    }

    /**
     * @return \Example\CampaignBundle\Domain\Specification\OpenCampaignSpecification
     */
    public function getOpenCampaignSpec()
    {
        return $this->openCampaignSpec;
    }
}

/*
 * Local Variables:
 * mode: php
 * coding: utf-8
 * tab-width: 4
 * c-basic-offset: 4
 * indent-tabs-mode: nil
 * End:
 */