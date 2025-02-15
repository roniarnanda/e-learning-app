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
| role         | required      |    enum (form select option)	   |
| password         | required      |    password	   |
| confirm_password         | required      |    password	   |

#### Result

```json
{
	"success": true,
    "message": "Berhasil Registrasi",
    "data": {
        "data" => $data
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

## Bagian 2: Manajemen Mata Kuliah & Kelas Online

### 1. Menampilkan mata kuliah

```json
GET /api/courses
```

#### Result

```json
{
	"success": true,
    "massage": "Berhasil memuat mata kuliah",
    "data": [{
        objectData
    }]
}
```

### 2. Dosen menambahkan mata kuliah

```json
POST /api/courses
```
#### Parameters

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| name         | required      |    string	   |
| description         | optional      |    text	   |

#### Result

```json
{
	"success": true,
    "message": "Data Mata Kuliah Berhasil Ditambahkan"
}
```