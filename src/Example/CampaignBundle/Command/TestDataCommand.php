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

namespace Example\CampaignBundle\Command;

use Example\CampaignBundle\Domain\Data\Campaign;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package    PHPMentors_Example_Symfony
 * @copyright  2013 GOTO Hidenori <hidenorigoto@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  New BSD License
 * @since      Class available since Release 1.0.0
 */
class TestDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:testdata');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $today = new \DateTime();

        $startDate = clone $today;
        $startDate->sub(new \DateInterval('P1D')); // 昨日開始
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P7D'));
        $campaign = new Campaign();
        $campaign->setTitle('開始しているキャンペーン1');
        $campaign->setDescription('キャンペーン1の説明');
        $campaign->setStartDate($startDate);
        $campaign->setEndDate($endDate);

        $this->getContainer()->get('doctrine')->getManager()->persist($campaign);

        $startDate = clone $today;
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P7D'));
        $campaign = new Campaign();
        $campaign->setTitle('開始しているキャンペーン2');
        $campaign->setDescription('キャンペーン2の説明');
        $campaign->setStartDate($startDate);
        $campaign->setEndDate($endDate);

        $this->getContainer()->get('doctrine')->getManager()->persist($campaign);

        $startDate = clone $today;
        $startDate->add(new \DateInterval('P1D')); // 明日開始
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P7D'));
        $campaign = new Campaign();
        $campaign->setTitle('開始していないキャンペーン3');
        $campaign->setDescription('キャンペーン3の説明');
        $campaign->setStartDate($startDate);
        $campaign->setEndDate($endDate);

        $this->getContainer()->get('doctrine')->getManager()->persist($campaign);

        $startDate = clone $today;
        $startDate->sub(new \DateInterval('P7D')); // 1週間前開始
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P1D')); // 終了済み
        $campaign = new Campaign();
        $campaign->setTitle('終了したキャンペーン4');
        $campaign->setDescription('キャンペーン4の説明');
        $campaign->setStartDate($startDate);
        $campaign->setEndDate($endDate);

        $this->getContainer()->get('doctrine')->getManager()->persist($campaign);

        $this->getContainer()->get('doctrine')->getManager()->flush();
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
