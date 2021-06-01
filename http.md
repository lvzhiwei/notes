## HTTP 首部

### 通用首部
- Cache-Control:
  缓存控制

### 请求首部
- If-Modified-Since: 2021-01-01
  用于判断客户端或者代理服务器本地的资源是否有效，服务器的资源是否更新过，
  如果没有更新过，则返回 304 Not Modified. 否则服务器返回最新的资源。
  
- If-Unmodified-Since
  与 If-Modified-Since 相反。
  如果资源在该时间后已更新，则响应 412 Precondition Failed
 
- If-None-Match: *
  传递的参数为之前的请求响应的 Etag，再次请求时，如果请求的服务器资源（如 html 文件）有变化，
  则该资源的 ETag 也会变化，两者不相等，就会响应新的资源。常用于使用 GET 或者 HEAD 来更新资源。
  如果两者匹配，则返回 304 Not Modified
  
 该 Header 与 If-Modified-Since 类似
  
- If-Match: 123456
  与 If-None-Match 相反。
  如果 ETag 与资源不匹配，则响应 412 Precondition Failed
- If-Range: 123456
  范围条件，与 Range 一起使用. If-Range 传 ETag 的值，Range: bytes=5001-10000. 如果 请求资源的 ETag 和
  请求中的 ETag 参数一致，表示资源没有更改，响应该范围值，200 OK。不一致则表示资源已修改，需响应完整的资源, 
  响应：206 Partial Content, Content-Range: bytes 5001-10000/10000, Content-Length: 5000。
  
- Max-Forwards
  最大通过转发的次数，每经过一层减 1，可以用于追踪请求传输路径，跟踪通信状况
  
- Range:
  范围请求，成功处理请求后响应 206 Partial Content；无法处理该范围请求时响应 200 OK 及全部资源。
  
- User-Agent:
  浏览器信息及用户代理信息等
  
  


  