<?php

declare(strict_types=1);

namespace ESputnik\ServiceProvider;

use Illuminate\Config\Repository;
use DtKt\ServiceManager\Contracts\{ServiceDescriptionInterface, ServiceProviderAutoInterface, ServiceProviderInterface};
use Illuminate\Contracts\Foundation\Application;
use Laravel\Nova\Fields\{Number, Password, Text};
use Laravel\Nova\Http\Requests\NovaRequest;

class EsputnikServiceProvider implements ServiceProviderInterface, ServiceProviderAutoInterface
{
    public function getCaption(): string
    {
        return 'ESputnik';
    }

    public function getNovaFields(NovaRequest $request, bool $action): array
    {
        return [
            Text::make('Логін', 'user')
                ->rules(['required', 'email']),
            Password::make('Пароль', 'password')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if (! empty($request[$requestAttribute])) {
                        $model->{$attribute} = $request[$requestAttribute];
                    }
                })
                ->creationRules(['required']),
            Number::make('Адресна книга', 'book')
                ->help('Не вказуйте, якщо не знаєте що це.')
                ->nullable()
                ->step(1)
                ->min(0),
        ];
    }

    public function checkConfig(?array $config): bool
    {
        return ! empty($config['user']) && ! empty($config['password']);
    }

    /**
     * @param  Application  $application
     * @param  array<ServiceDescriptionInterface>  $services
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(Application $application, array $services): void
    {
        /** @var Repository $config */
        $config = $application->make('config');
        $default = null;

        foreach ($services as $service) {
            $config->set("esputnik.accounts.{$service->getName()}", $service->getConfig());
            if($service->getName() === 'default') {
                $default = false;
            }
            if ($service->isDefault()) {
                $default = $default !== false;
                $config->set("esputnik.default", $service->getName());
            }
        }
        if($default) {
            $config->set("esputnik.accounts.default", null);
        }
    }
}
