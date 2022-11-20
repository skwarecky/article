### 1. Clone repository

```bash
https://github.com/skwarecky/article.git
```

### 2. Open docker desktop (win) or run docker

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


