#### Resource URL
`GET /api/boards/{name}/threads/{thread_num}/pages/{page_num}`

#### Description
  Gets posts from chat page by it's number, thread number and board name

#### Resource information:
  Requires authentication: no
  Response formats: `JSON`

#### Url parameters
| type     | required  | name                 | description
|----------|-----------|----------------------|-------------
| `string` | required  | name                 | Board name
| `string` | required  | thread_num           | Chat number
| `string` | default:1 | page_num             | Chat page


#### Example Request
```javascript
GET /boards/test/threads/5/pages/10
```

#### Example Result
```javascript
//TODO
```