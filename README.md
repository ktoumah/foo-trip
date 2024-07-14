This project is a Symfony 7 test.

# Requirements for this project.

[<img src="https://img.shields.io/badge/Os : -Ubuntu 20.04.5 LTS-informational.svg?logo=jwt">]()
[<img src="https://img.shields.io/badge/Docker : -4.13.x-informational.svg?logo=jwt">]()

Just lunch this command from the source of project and the job will be done 😃

```bash
  make run
  ```

> You can access project from : http://localhost:8005/
> 
> You can access admin sign in page from : http://localhost:8005/login

#

> **(!)** There are some issues due to slow internet connexion when 
>lunching `make run` command, 
>if you have an error please connect to a fast network, delete docker container if it was created and rerun the same command it will be fixed.

> **(!)** If you want to access to php project container, run this command:
>```bash
>   make sh_app
>   ```

> **(!)** There is more helpful commands inside `./makefile`.
