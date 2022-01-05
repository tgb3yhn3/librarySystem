
import requests
import json
from bs4 import BeautifulSoup
import sys  
import time
from fake_useragent import UserAgent
# 第一層
params = sys.argv[1]
headers = {
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", 
    "Accept-Encoding": "gzip, deflate, br", 
    "Accept-Language": "zh-TW,zh;q=0.9", 
    
    "Sec-Fetch-Dest": "document", 
    "Sec-Fetch-Mode": "navigate", 
    "Sec-Fetch-Site": "none", 
    "Upgrade-Insecure-Requests": "1", 
    "User-Agent": "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36" #使用者代理
}

response = requests.get("https://search.books.com.tw/search/query/key/"+params+"/cat/BKA",headers=headers)
# response = requests.get("https://search.books.com.tw/search/query/key/9789574554089/cat/BKA")
soup = BeautifulSoup(response.text, "html.parser")
a_tags = soup.find_all('div',class_="box_1")
for tag in a_tags:
    link = tag.a.get('href')
goal = link.index('item/')
end = link.index('/page')
# --------------------------

# 第二層
response1 = requests.get("https://www.books.com.tw/products/"+link[goal+5:end],headers=headers)
soup1 = BeautifulSoup(response1.text, "html.parser")
# --------------------------

# 簡介
data = soup1.find_all('meta',limit=4)
text = response1.text[response1.text.index('<div class="content" style="height:auto;">')+42:response1.text.index('</div><div class="type02_gradient" style="display:none;">')]
# text = text.replace('<strong>',"")
# text = text.replace('</strong>',"")
# text = text.replace('<STRONG>',"")
# text = text.replace('</STRONG>',"")
# text = text.replace('<P>',"")
# text = text.replace('</P>',"")
# text = text.replace('<p>',"")
# text = text.replace('</p>',"")
# text = text.replace('<div>',"")
# text = text.replace('</div>',"")
# text = text.replace('<ul>',"")
# text = text.replace('</ul>',"")
# text = text.replace('<li>',"")
# text = text.replace('\n',"")
# print(text)
# ---------------------------
#圖片網址
img_large = response1.text[response1.text.index('cover M201106_0_getTakelook_')+59:response1.text.index('cover M201106_0_getTakelook_')+200]
img_url = img_large[:img_large.index('alt="')-2]
# ---------------------------
#print(data)
total = str(data)[str(data).index('書名'):str(data).index('類別')-1]
start=response1.text.index('og:title" content="')+len('og:title" content="')
temp=response1.text[start:]

# print(total)
seperate = total.split("，")

book_name = response1.text[start:start+temp.index('"/>')]

for i in seperate:
    if i[:2]=="作者":
        author = i[3:]
        # print(author)
        break
for i in seperate:
    if i[:3]=="出版社":
        company = i[4:]
        # print(book_name)
        break
for i in seperate:
    if i[:4]=="出版日期":
        date = i[5:]
        # print(date)
        break
text=text.replace('\'','')
book_json = {'book_name':book_name,'author':author,'company':company,'date':date,'img_url':img_url,'text':text}
str1 = json.dumps(book_json,ensure_ascii=True)
# bs=str1.encode('cp950')

print(str1)
    