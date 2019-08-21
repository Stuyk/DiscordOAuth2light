<?php
/**
 *
 * DOL -Discord Oauth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace OAuth\OAuth2\Service;

use	OAuth\OAuth2\Token\StdOAuth2Token;
use	OAuth\Common\Http\Exception\TokenResponseException;
use	OAuth\Common\Http\Uri\Uri;
use	OAuth\Common\Consumer\CredentialsInterface;
use	OAuth\Common\Http\Client\ClientInterface;
use	OAuth\Common\Storage\TokenStorageInterface;
use	OAuth\Common\Http\Uri\UriInterface;

class discord extends AbstractService
{
	public function	__construct(
		CredentialsInterface $credentials,
		ClientInterface	$httpClient,
		TokenStorageInterface $storage,
		$scopes = [],
		UriInterface $baseApiUri = null
	)
	{
		parent::__construct($credentials, $httpClient, $storage, $scopes, $baseApiUri);

		if (null === $baseApiUri)
		{
			$this->baseApiUri = new	Uri('https://discordapp.com/api/');
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthorizationEndpoint()
	{
		return new Uri('https://discordapp.com/api/oauth2/authorize');
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAccessTokenEndpoint()
	{
		return new Uri('https://discordapp.com/api/oauth2/token');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getAuthorizationMethod()
	{
		return static::AUTHORIZATION_METHOD_HEADER_BEARER;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function parseAccessTokenResponse($responseBody)
	{
		$data = json_decode($responseBody, true);

		if (null === $data || !is_array($data))
		{
			throw new TokenResponseException('Unable to parse response.');
		}
		elseif (isset($data['error']))
		{
			throw new TokenResponseException('Error in retrieving token: "' . $data['error'] . '"');
		}

		/**
		 * Discord's token expires in 1 week (604800 seconds)
		 * Let's the logic discover it itself though.
		 */
		$token = new StdOAuth2Token();

		$token->setAccessToken($data['access_token']);

		if (isset($data['expires_in']))
		{
			$token->setLifetime($data['expires_in']);
			unset($data['expires_in']);
		}

		if (isset($data['refresh_token']))
		{
			$token->setRefreshToken($data['refresh_token']);
			unset($data['refresh_token']);
		}

		unset($data['access_token']);

		$token->setExtraParams($data);

		return $token;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthorizationUri(array $additionalParameters = [])
	{
		$parameters = array_merge(
			$additionalParameters,
			[
				'client_id'			=> $this->credentials->getConsumerId(),
				'redirect_uri'		=> $this->credentials->getCallbackUrl(),
				'response_type'		=> 'code',
				'scope'				=> 'identify',
				/**
				 * If the user has previously authorized our application
				 * then skip the authorization screen and redirect it back to us.
				 */
				'prompt'			=> 'none'
			]
		);

		/* Build the url */
		$url = clone $this->getAuthorizationEndpoint();

		foreach ($parameters as $key => $val)
		{
			$url->addToQuery($key, $val);
		}

		return $url;
	}
}
