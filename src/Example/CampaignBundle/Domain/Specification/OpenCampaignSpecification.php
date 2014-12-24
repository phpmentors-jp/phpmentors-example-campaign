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

namespace Example\CampaignBundle\Domain\Specification;

use Doctrine\Common\Collections\ArrayCollection;
use Example\CampaignBundle\Domain\Data\Campaign;
use Example\CampaignBundle\Domain\Data\Repository\CampaignRepository;
use Example\CampaignBundle\Domain\Util\Clock;

/**
 * @package    PHPMentors_Example_Symfony
 * @copyright  2013 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      Class available since Release 1.0.0
 */
class OpenCampaignSpecification
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
     * @param  Campaign $campaign
     * @return bool
     */
    public function isSatisfiedBy(Campaign $campaign)
    {
        if (
            ($campaign->getStartDate() <= $this->clock->getCurrentDateTime()) &&
            ($campaign->getEndDate() > $this->clock->getCurrentDateTime())
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  CampaignRepository $campaignRepository
     * @return ArrayCollection
     */
    public function satisfyingElementsFrom(CampaignRepository $campaignRepository)
    {
        $campaignList = $campaignRepository->findAll();
        $campaignList = $campaignList->filter(function ($campaign) { return $this->isSatisfiedBy($campaign); });

        return $campaignList;
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
