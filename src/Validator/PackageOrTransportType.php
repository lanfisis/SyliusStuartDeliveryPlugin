<?php

/*
 * This file is part of Monsieur Biz' Stuart delivery plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusStuartDeliveryPlugin\Validator;

use Symfony\Component\Validator\Constraint;

final class PackageOrTransportType extends Constraint
{
    public string $message = 'monsieurbiz_stuart_delivery_plugin.no_package_type_and_no_transport_type';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
