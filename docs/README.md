# phpBB Studio - Discord Oauth2 light

## Installation

Copy the extension to phpBB/ext/phpbbstudio/nore

Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB Studio - Discord Oauth2 light" extension.

## Application settings:

https://discordapp.com/developers/applications/ (New application)

Copy and save the `Client ID` and `Client Secret` to use in the `ACP / Client communication / Authentication` page.

## OAuth2 Redirects:

Two links is what you need to use in Redirects for the application to work (http or https is ok)

`http://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=discord`

`http://www.example.com/board/ucp.php?i=ucp_auth_link&mode=auth_link&link=1&oauth_service=discord`

replace `http://www.example.com/board` with your Board's URL ;-D

## Scopes:

`identity`

## License

[GPLv2](license.txt)
