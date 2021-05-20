# test-api-server
![Travis (.org)](https://img.shields.io/travis/howToCodeWell/test-api-server)

A  Test API Server written in Symfony for mocking external API responses.

## Install
This will download the Docker images, run the containers and install the vendor packages.
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


## Docker build with Xdebug
${HOST_IP} should be the IP of the VM that you are using. 

```bash
docker build -t test-api-server --build-arg APP_ENV=dev --build-arg HOST_IP=${HOST_IP} .
docker run --rm --name=test-api-server -it -p 8080:80 test-api-server
```


## Contributing
Pull requests and issues are welcome but please run `make test` before submitting any PRs as this will perform code analysis and run the test suites
## Mock GitHub API

### Authorize
POST/GET http://localhost:8080/github/login/oauth/authorize?state=dummyRandomState

BODY

state=dummyRandomState

### Generate access token
POST/GET http://localhost:8080/github/login/oauth/access_token

BODY 

code=dummyRandomCode

### Get a user
GET http://localhost:8080/github/api/v3/user

HEADERS 

Authorization = Bearer dummyAccessToken

Please see http://localhost:8080/api/doc for more endpoints

