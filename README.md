# CCSE CW1
Car financing website.

## Setup
Go to `./setupfiles/README.md` for setup guidance.

## Accounts in the db:

| email                            | password  | description         |
| -------------------------------- | --------- | ------------------- |
| 1@1.com                          | pass      | Boiler plate user   |
| za@gmail.com                     | password! | Financing test user |
| global.finance.mail.a1@gmail.com | admin     | Admin               |

# CCSE CW2
Security testing and CI/CD

## Static code testing with sonarqube scanner
sonar qube has been installed on the main CS VM with a default H2 database. 
- user name: admin
- passowrd: toast

To start sonarqube:
1. go to `~/opt/sonarqube<version>/bin/linux-x86-64`
2. Use command `./sonar.sh console`
3. Watch for errors
4. If successfull go to http://localhost:9000

To scan the site:
1. go to root directory of this project
2. use command: `sonar-scanner   -Dsonar.projectKey=ccse-cw2   -Dsonar.sources=.   -Dsonar.host.url=http://localhost:9000   -Dsonar.token=sqp_b63066c3eceb7073071c002c77e09c5d790a37fa`
3. Check for results on the sonarqube dashboard at http://localhost:9000


## Web application testing with OWASP ZAP
OWASP ZAP has been installed on the main CS VM. You can open the GUI by searching for it. 

Set proxy of broswer:
1. open firefox settings
2. search proxy and go to network settings.
3. set proxy to manual
4. use `localhost` and port `8080`
5. check 'also use for https' box

The website must be running for this scan to work. 
Use the URL of the locally hosted website for scanning.
Do an automatic scan. After that is done, search through the alerts tab for more details.