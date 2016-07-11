<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        // todo: refactor this
        if (!in_array($this->getEnvironment(), array('front'))) {
            $bundles = array(
                new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
                new Symfony\Bundle\SecurityBundle\SecurityBundle(),
                new Symfony\Bundle\TwigBundle\TwigBundle(),
                new Symfony\Bundle\MonologBundle\MonologBundle(),
                new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
                // new Symfony\Bundle\AsseticBundle\AsseticBundle(),
                new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
                new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

                new Escape\WSSEAuthenticationBundle\EscapeWSSEAuthenticationBundle(),
                new FOS\RestBundle\FOSRestBundle(),
                new JMS\SerializerBundle\JMSSerializerBundle(),
                new AntiMattr\GoogleBundle\GoogleBundle(),

                new Sonata\CoreBundle\SonataCoreBundle(),
                new \Sonata\BlockBundle\SonataBlockBundle(),
                new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
                new Sonata\AdminBundle\SonataAdminBundle(),
                new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
                new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),

                new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),

                // new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
                new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
                // new Sonata\FormatterBundle\SonataFormatterBundle(),

                // for layout menu
                new Knp\Bundle\MenuBundle\KnpMenuBundle(),

                // for pagination
                // new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
                // for pagination alternative variant
                new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

                // for add tinymce
                new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),

                new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
                new Dizda\CloudBackupBundle\DizdaCloudBackupBundle(),

                // for send push
                new RMS\PushNotificationsBundle\RMSPushNotificationsBundle(),

                // for pdf import
                new TFox\MpdfPortBundle\TFoxMpdfPortBundle(),

                // for notification
                new Sonata\NotificationBundle\SonataNotificationBundle(),
                new Application\Sonata\NotificationBundle\ApplicationSonataNotificationBundle(),

                new FOS\UserBundle\FOSUserBundle(),
                new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
                new Tim\CheatSheetBundle\TimCheatSheetBundle(),
                new Tim\ExampleBundle\TimExampleBundle(),
                new Tim\UtilsBundle\TimUtilsBundle(),
            );
        } else {
            $bundles = array(
                new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
                new Symfony\Bundle\SecurityBundle\SecurityBundle(),
                new Symfony\Bundle\TwigBundle\TwigBundle(),
                new Symfony\Bundle\MonologBundle\MonologBundle(),
                new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
                new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
                new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),

                // for layout menu
                new Knp\Bundle\MenuBundle\KnpMenuBundle(),

                new Tim\ExampleBundle\TimExampleBundle(),
            );

            // for multi step form
            $bundles[] = new Craue\FormFlowBundle\CraueFormFlowBundle();
        }

        # uncomment for show debug profiler
//        if (in_array($this->getEnvironment(), array('dev', 'front', 'test'))) {
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Hautelook\AliceBundle\HautelookAliceBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
