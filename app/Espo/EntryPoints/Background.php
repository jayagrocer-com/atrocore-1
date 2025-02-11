<?php
/*
 * This file is part of EspoCRM and/or AtroCore.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2019 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.espocrm.com
 *
 * AtroCore is EspoCRM-based Open Source application.
 * Copyright (C) 2020 AtroCore UG (haftungsbeschränkt).
 *
 * AtroCore as well as EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AtroCore as well as EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word
 * and "AtroCore" word.
 */

namespace Espo\EntryPoints;

use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\NotFound;
use Espo\Entities\Attachment;

/**
 * Class Background
 */
class Background extends AbstractEntryPoint
{
    public static $authRequired = false;

    protected $backgrounds
        = [
            [
                'authorName' => 'Alesia Kazantceva',
                'authorLink' => 'https://unsplash.com/@saltnstreets',
                'imageName'  => 'alesia-kazantceva-VWcPlbHglYc-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/alesia-kazantceva-VWcPlbHglYc-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Austin Distel',
                'authorLink' => 'https://unsplash.com/@austindistel',
                'imageName'  => 'austin-distel-wawEfYdpkag-unsplash.jpg',
                'imagePath'  => 'client/img/background/austin-distel-wawEfYdpkag-unsplash.jpg',
            ],
            [
                'authorName' => 'Dane Deaner',
                'authorLink' => 'https://unsplash.com/@danedeaner',
                'imageName'  => 'dane-deaner-_-KLkj7on_c-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/dane-deaner-_-KLkj7on_c-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Lance Anderson',
                'authorLink' => 'https://unsplash.com/@lanceanderson',
                'imageName'  => 'lance-anderson-QdAAasrZhdk-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/lance-anderson-QdAAasrZhdk-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Laura Davidson',
                'authorLink' => 'https://unsplash.com/@lauradavidson',
                'imageName'  => 'laura-davidson-QBAH4IldaZY-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/laura-davidson-QBAH4IldaZY-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Liane Metzler',
                'authorLink' => 'https://unsplash.com/@liane',
                'imageName'  => 'liane-metzler-v3bWNXeInQA-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/liane-metzler-v3bWNXeInQA-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Luca Bravo',
                'authorLink' => 'https://unsplash.com/@lucabravo',
                'imageName'  => 'luca-bravo-SRjZtxsK3Os-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/luca-bravo-SRjZtxsK3Os-unsplash-min.jpg',
            ],
            [
                'authorName' => 'LYCS Architecture',
                'authorLink' => 'https://unsplash.com/@lycs',
                'imageName'  => 'lycs-architecture-aKij95Mmus8-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/lycs-architecture-aKij95Mmus8-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Scott Webb',
                'authorLink' => 'https://unsplash.com/@scottwebb',
                'imageName'  => 'scott-webb--udZnjsCzsE-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/scott-webb--udZnjsCzsE-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Viktor Jakovlev',
                'authorLink' => 'https://unsplash.com/@apviktor',
                'imageName'  => 'viktor-jakovlev-H0vuplqoX0c-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/viktor-jakovlev-H0vuplqoX0c-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Toa Heftiba',
                'authorLink' => 'https://unsplash.com/@apviktor',
                'imageName'  => 'toa-heftiba-FV3GConVSss-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/toa-heftiba-FV3GConVSss-unsplash-min.jpg',
            ],
            [
                'authorName' => 'Martin Sanchez',
                'authorLink' => 'https://unsplash.com/@martinsanchez',
                'imageName'  => 'martin-sanchez-U4wRSVKO2Q0-unsplash-min.jpg',
                'imagePath'  => 'client/img/background/martin-sanchez-U4wRSVKO2Q0-unsplash-min.jpg',
            ],
        ];

    public function run()
    {
        session_start();

        if (!isset($_SESSION['background']) || $_SESSION['background']['till'] < new \DateTime() || !file_exists($_SESSION['background']['imagePath'])) {
            $_SESSION['background'] = $this->backgrounds[array_rand($this->backgrounds)];
            $_SESSION['background']['till'] = (new \DateTime())->modify('+2 hours');
        }

        header("Location: {$_SESSION['background']['imagePath']}", true, 302);
        exit;
    }
}
