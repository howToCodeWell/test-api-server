# test-api-server
A  Test API Server written in Symfony for mocking external API responses.

## Install
This will download the Docker images, run the containers, install the vendor packages and run the tests
```bash
$ make install
```
## Test
This will run all the tests including code checks
```bash
$ make test
```
## Uninstall
This will remove the Docker objects
```bash
$ make uninstall
```
## Contributing
Pull requests and issues are welcome but please run `make test` before submitting any PRs as this will perform code analysis and run the test suites
## Mock GitHub API

### Get access token
POST/GET http://localhost:8080/github/login/oauth/access_token

BODY 

code=test123Code

### Get a user
GET http://localhost:8080/github/api/v3/user

HEADERS 

Authorization = Bearer test123


