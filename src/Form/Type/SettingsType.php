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

namespace MonsieurBiz\SyliusStuartDeliveryPlugin\Form\Type;

use MonsieurBiz\SyliusSettingsPlugin\Form\AbstractSettingsType;
use MonsieurBiz\SyliusSettingsPlugin\Form\SettingsTypeInterface;
use MonsieurBiz\SyliusStuartDeliveryPlugin\Validator\PickupAddress;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SettingsType extends AbstractSettingsType implements SettingsTypeInterface
{
    public const API_MODE_SANDBOX = 'sandbox';

    public const API_MODE_PRODUCTION = 'production';

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isDefaultForm = $this->isDefaultForm($builder);
        $constraints = $isDefaultForm ? [
            new Assert\NotBlank(),
        ] : [];

        $this->addWithDefaultCheckbox(
            $builder,
            'api_mode',
            ChoiceType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.api_mode',
                'required' => true,
                'constraints' => $constraints,
                'choices' => [
                    'monsieurbiz_stuart_delivery_plugin.settings.api_mode_sandbox' => self::API_MODE_SANDBOX,
                    'monsieurbiz_stuart_delivery_plugin.settings.api_mode_production' => self::API_MODE_PRODUCTION,
                ],
            ]
        );

        $this->addWithDefaultCheckbox(
            $builder,
            'api_client_id',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.api_client_id',
                'required' => true,
                'constraints' => $constraints,
            ]
        );

        $this->addWithDefaultCheckbox(
            $builder,
            'api_client_secret',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.api_client_secret',
                'required' => true,
                'constraints' => $constraints,
            ]
        );

        $this->addWithDefaultCheckbox(
            $builder,
            'address',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.address',
                'required' => true,
                'constraints' => $constraints,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'postcode',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.postcode',
                'required' => true,
                'constraints' => $constraints,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'city',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.city',
                'required' => true,
                'constraints' => $constraints,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'phone_number',
            TextType::class,
            [
                'label' => 'monsieurbiz_stuart_delivery_plugin.settings.phone_number',
                'required' => false,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setNormalizer('constraints', function (OptionsResolver $resolver, $value) {
            return array_merge($value, [new PickupAddress()]);
        });
    }
}
