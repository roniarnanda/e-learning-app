# Membangun Aplikasi E-Learning Kampus dengan Laravel

## Bagian 1: Authentikasi Pengguna

### 1. Register

```json
POST /api/register
```
#### Parameters

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| name         | required      |    string	   |
| email         | required      |    string	   |
| role         | required      |    enum(form select option)	   |
| password         | required      |    password	   |
| confirm_password         | required      |    password	   |

#### Result

```json
{
	"success": true,
    "message": "Berhasil Registrasi",
    "data": {
        "data"
    }
}
```

### 2. Login

```json
POST /api/login
```
#### Parameters

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| email         | required      |    string	   |
| password         | required      |    password	   |

#### Result

```json
{
	"success": true,
    "message": "Berhasil Login",
    "data": {
        "token": "data token"
    }
}
```

### 3. Logout

```json
POST /api/logout
```
#### Parameters

Tanpa inputan

#### Result

```json
{
	"message": "Berhasil Logout"
}
```
