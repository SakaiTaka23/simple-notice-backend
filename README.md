# simple-notice-backend

* アンケートを取るようなアプリケーションを作成する



## 機能

* ログインなしでアンケートを作成、回答できるようにしたい
* 結果は答えた人、期限が過ぎたもののみ閲覧可能
* 答えたかどうかはIP管理 or クッキー
* アンケートには期限を設けることができるようにする
* 解答は基本的に選択肢にしたい
* アンケート一つあたりの問題数上限は10問
* わかりやすいように回答はグラフを表示させる
* アンケートの回答者についての情報も入れる
* できたらアンケートに画像、動画を表示できるようにしたい
* ログインとかできて解答したものを見返せるようにしたい→解答期間終了したものは消すならいらない



## API

1.  idから問題を取得
2.  回答を得てDBに保存

3. idから割合や解答を表示
4. 情報から問題を作成
5. 解答可能な問題一覧を得る



## ルーティング

* idはhashedidを使いたいな! **laravel-hashidsを確認**
* apiなので前に http://localhost/api/ がつく

| route       | method | description              |
| ----------- | ------ | ------------------------ |
| /survey/:id | get    | idからアンケート情報取得 |
| /survey     | get    | アンケート一覧取得       |



## DB

* 必要になりそうなテーブル

### relation

* survey has many question
* question is owned by survey



* survey has many result
* result is owned by survey

**Survey**

* 調査の元データを格納
* 問題数、回答者数とかはリレーションで計算したい→カラムには入れない
* 出題者はログイン機能を作成するならnullableにしてidとか保存したほうがいいかも?

| column      | type   | description                          |
| ----------- | ------ | ------------------------------------ |
| id          | id     |                                      |
| title       | string | アンケート全体のタイトル             |
| description | string | タイトルの詳細                       |
| owner       | string | 出題者                               |
| from        | date   | 解答期間いつから                     |
| to          | date   | いつまで                             |
| delete_pass | string | アンケートを削除するためのパスワード |


**questions**

* 調査の質問を格納

| column          | type               | description  |
| --------------- | ------------------ | ------------ |
| id              | id                 |              |
| survey_id       | unsignedBigInteger | relation     |
| question_number | number             | 質問の順番   |
| type            | string             | inputの種類  |
| name            | string             | htmlのname   |
| title           | string             | 質問の内容   |
| is_required     | boolean            | 必須かどうか |
| choices         | json nullable      | 選択肢       |

**result**

* 回答のデータ格納
* 未完成

| column    | type               | description |
| --------- | ------------------ | ----------- |
| id        | id                 |             |
| survey_id | unsignedBigInteger | relation    |






## Todo

* [x] 必要な値をもとにapiの形を定義
* [x] idから情報を取得
* [ ] 回答可能アンケート表示→今のところ期限を設けることはしなくていいかも?
* [x] surveyテーブルにtitle,descriptionを付け加えてapiにも反映させること
* [x] survey apiにdelete keyを流さないようにすること
* [ ] survey / id の時もdelete keyを流さないようにすること
* [ ] choicesを文字列ではなく配列に直す

