# Membangun Aplikasi E-Learning Kampus dengan Laravel

## Bagian 1: Authentikasi Pengguna

### 1. Register

```json
POST /api/register
```
#### Parameters

| Parameters    |               | data type  |
| ------------- |:-------------:| -------------|
| id   | required	  	| autoincrement |
| name         | required      |    string	   |
| email         | required      |    string	   |
| role         | required      |    enum(form select option)	   |
| password         | required      |    password	   |
| confirm_password         | required      |    password	   |

#### Result

```json
{
	"success": true,
    "message": "Message",
    "data": {
        "data"
    }
}
```
