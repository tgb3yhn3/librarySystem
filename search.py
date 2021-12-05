# encoding:utf-8
import requests
import json
from bs4 import BeautifulSoup
import sys  
# 第一層
params = sys.argv[1]
headers = {'user-agent': 'Mozilla/5.0 (Macintosh Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'}
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
response1 = requests.get("https://www.books.com.tw/products/"+link[goal+5:end])
soup1 = BeautifulSoup(response1.text, "html.parser")
# --------------------------

# 簡介
data = soup1.find_all('meta',limit=4)
text = response1.text[response1.text.index('<div class="content" style="height:auto;">')+42:response1.text.index('</div><div class="type02_gradient" style="display:none;">')].replace('<br />',"")
text = text.replace('<strong>',"")
text = text.replace('</strong>',"")
text = text.replace('<STRONG>',"")
text = text.replace('</STRONG>',"")
text = text.replace('<P>',"")
text = text.replace('</P>',"")
text = text.replace('<p>',"")
text = text.replace('</p>',"")
text = text.replace('\n',"")
# print(text)
# ---------------------------
#圖片網址
img_large = response1.text[response1.text.index('cover M201106_0_getTakelook_P00a400020052_image_wrap')+59:response1.text.index('cover M201106_0_getTakelook_P00a400020052_image_wrap')+200]
img_url = img_large[:img_large.index('alt="')-2]
# ---------------------------
total = str(data)[str(data).index('書名'):str(data).index('類別')-1]
seperate = total.split("，")
for i in seperate:
    if i[:2]=="書名":
        book_name = i[3:]
        # print(book_name)
        break
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
book_json = {'book_name':book_name,'author':author,'company':company,'date':date,'img_url':img_url,'text':text}
str1 = json.dumps(book_json,ensure_ascii=False)
print(str1)