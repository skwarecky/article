### 1. Clone repository

```bash
https://github.com/skwarecky/article.git
```

### 2. Open docker desktop (win) or run docker
```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html  \
  -w /var/www/html \
  laravelsail/php81-composer:latest \
  composer install --ignore-platform-reqs
```

### 3. Run sail
```bash
./vendor/bin/sail up -d
```

### 4. Install dependencies
```bash
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### 5. Setup database with default data
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### Test
```bash
./vendor/bin/sail artisan test
```

### Storage
```bash
./vendor/bin/sail artisan storage:link
```
