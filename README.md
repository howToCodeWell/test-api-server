# test-api-server
A  Test API Server written in Symfony for mocking external API responses.

## Mock GitHub API

### Get access token
POST/GET http://localhost:8080/github/login/oauth/access_token

BODY 

code=test123Code

### Get a user
GET http://localhost:8080/github/api/v3/user

HEADERS 

Authorization = Bearer test123

