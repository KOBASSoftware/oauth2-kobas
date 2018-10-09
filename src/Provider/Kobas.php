<?php

namespace Kobas\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Kobas extends AbstractProvider
{
    use BearerAuthorizationTrait;
    /**
     * Default scopes
     *
     * @var array
     */
    public $defaultScopes = ['integration'];

    /**
     * Kobas OAuth URL
     *
     * @var string
     */
    public $url = 'https://oauth.kobas.co.uk';

    /**
     * Kobas Company ID
     *
     * @var int
     */
    public $companyId;

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return $this->url . '/authorize';
    }


    /**
     * Get access token url to retrieve token
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->url . '/access_token?x-kobas-company-id=' . $this->companyId;
    }

    /**
     * Get provider url to fetch user details
     *
     * @param  AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->url . '/me';

    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return $this->defaultScopes;
    }

    /**
     * Returns the string that should be used to separate scopes when building
     * the URL for requesting an access token.
     *
     * @return string Scope separator, defaults to ' '
     */
    protected function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * Check a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  string $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        $acceptableStatuses = [200, 201];
        if (!in_array($response->getStatusCode(), $acceptableStatuses)) {
            throw new IdentityProviderException(
                $data['message'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param object $response
     * @param AccessToken $token
     * @return KobasResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new KobasResourceOwner($response);
    }
}