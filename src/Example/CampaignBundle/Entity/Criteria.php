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

use PHPMentors\DomainKata\Entity\CriteriaInterface;

class Criteria extends \Doctrine\Common\Collections\Criteria implements CriteriaInterface
{
}
