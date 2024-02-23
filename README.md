## Requirements
* git
* docker
* docker-compose
* make (`sudo apt-get -y install make`)

## How to run
- Before anything else make sure your system meet the requirements
- Create a network first:
```bash
make create-network
```
- After that you can run the services using:
```bash
make start-all
```

- Go to `users` folder and run migration
```bash
make migrate 
```


- Check `Makefile` for more info.