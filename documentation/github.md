# Importing - Github

Github requires that we use your **username** and a **personal access token** in order to pull down files from their API.

## Personal Access Token

A personal access token allows us to make API calls on your behalf. The API calls that we are making are **ONLY** used to download files from Github, and they are never sent to our system. _All calls are made on your end!_

To generate a `personal access token` you will need to have a Github account.

 * On the **"Settings"** page on your Github profile.
 * Click the link to **Personal access tokens**
 * Click the button for **Generate new token**
 * Follow the password prompt
 * Add a description for this access token _(example: documentation)_
 * Ensure that the following access has been checked
  * repo:status
  * repo_deployment
  * public_repo

**Remember that this token is only shown once, so take note of it if you plan to use it else where**.