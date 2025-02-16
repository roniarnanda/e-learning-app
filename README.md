# Membangun Aplikasi E-Learning Kampus dengan Laravel

## Bagian 1: Authentikasi Pengguna

### 1. Register

```json
POST /api/register
```
#### Parameters Inputan

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
#### Parameters Inputan

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
#### Parameters Inputan

Tanpa inputan

#### Result

```json
{
	"message": "Berhasil Logout"
}
```

#

## Bagian 2: Manajemen Mata Kuliah & Kelas Online

### 1. Menampilkan mata kuliah

```json
GET /api/courses
```

#### Result

```json
{
	"success": true,
    "massage": "Berhasil memuat data",
    "data": [
        {
            "id": "id",
            "name": "name",
            "description": "description",
            "lecture_id": 1,
            "lecture": {
                "id": "id",
                "name": "name",
                "email": "email",
                "email_verified_at": null,
                "role": "role",
            }
        }]
}
```

### 2. Dosen menambahkan mata kuliah

```json
POST /api/courses
```
#### Parameters Inputan

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

### 3. Dosen mengedit mata kuliah

```json
PUT /api/courses/{id}
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| name         | optional      |    string	   |
| description         | optional      |    text	   |

#### Result

```json
{
	"success": true,
    "massage": "Berhasil mengubah data mata kuliah",
}
```

### 3. Dosen menghapus mata kuliah

```json
DELETE /api/courses/{id}
```
#### Parameters Inputan


#### Result

```json
{
	"success": true,
    "massage": "Berhasil menghapus mata kuliah"
}
```

### 4. Mahasiswa mendaftar mata kuliah

```json
POST /api/courses/{id}/enroll
```
#### Parameters Inputan


#### Result

```json
{
	"success": true,
    "massage": "Mahasiswa berhasil mendaftar mata kuliah"
}
```

#

## Bagian 3: Upload & Unduh Materi Perkuliahan

### 1. Dosen mengupload materi

```json
POST /api/materials
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| course_id         | required      |    select option from courses |
| title         | required      |    string	   |
| file         | required      |    file	   |

#### Result

```json
{
    "success": true,
    "message": "Data Materi Berhasil Ditambahkan"

}
```

### 2. Mahasiswa mengunduh materi

```json
GET /api/materials/{id}/download
```
#### Parameters Inputan

#### Result
File download

#

## Bagian 4: Tugas & Penilaian

### 1. Dosen memberikan tugas

```json
POST /api/assignments
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| title         | required      |    string	   |
| course_id         | required      |    select option from courses |
| description         | required      |    text	   |
| deadline         | required      |    datetime	   |

#### Result

```json
{
    "success": true,
    "message": "Data tugas berhasil ditambahkan"

}
```

### 2. Mahasiswa mengungggah jawaban

```json
POST /api/submissions
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| assignment_id         | required      |    select option from assignment |
| file         | required      |    file	   |

#### Result

```json
{
    "success": true,
    "message": "Jawaban berhasil diunggah"

}
```

### 3. Dosen memberi nilai

```json
POST /api/submissions/{$id}/grade
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| score         | required      |    integer	   |

#### Result

```json
{
    "success": true,
    "message": "Nilai telah diberikan"

}
```

#

## Bagian 5: Forum & Diskusi

### 1. Mahasiswa & Dosen membuat diskusi

```json
POST /api/discussions
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| course_id         | required      |    select option from courses |
| content         | required      |    text	   |

#### Result

```json
{
    "success": true,
    "message": "Berhasil menambahkan diskusi"

}
```

### 2. Mahasiswa & Dosen membalas diskusi

```json
POST /api/discussions/{id}/replies
```
#### Parameters Inputan

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| content         | required      |    text	   |

#### Result

```json
{
    "success": true,
    "message": "Berhasil menambahkan balasan diskusi"
}
```
#

## Bagian 6: Laporan & Statistik

### 1. Statistik jumlah mahasiswa per mata kuliah

```json
GET /api/reports/courses
```

#### Result

```json
{
	"success": true,
    "message": "Berhasil memuat statistik mata kuliah",
    "data": [
        {
            "id": "id",
            "name": "name",
            "description": "description",
            "count_student": "count_student"
        }
    ]
}
```

### 2. Statistik tugas yang sudah/belum dinilai

```json
GET /api/reports/assignments
```

#### Result

```json
{
	"success": true,
    "message": "Berhasil memuat statistik penugasan",
    "data": [
        {
            "id": "id",
            "title": "title",
            "description": "description",
            "all_score": "all_score",
            "with_score": "with_score",
            "no_score": "no_score"
        }
    ]
}
```

### 3. Statistik tugas yang sudah/belum dinilai

```json
GET /api/reports/students/{id}
```

#### Result

```json
{
	"success": true,
    "message": "Berhasil memuat statistik tugas dan nilai mahasiswa",
    "data": [
        {
            "course_id": "id",
            "title": "title",
            "score": "score"
        }
    ]
}
```