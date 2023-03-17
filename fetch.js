function sendFetch() {
  fetch(url, {
    method: 'POST',
    body: JSON.stringify(dataSet),
  })
    .then((data) => data.json())
    .then((json) => {});
}

// //////////////////////!SECTION

const fetch = new Promise((resolve, reject) => {
  resolve, reject;
});

function getFetch() {
  return new Promise(function (resolve, reject) {
    fetch(url)
      .then((res) => res.json())
      .then((data) => resolve(data))
      .catch((err) => reject(err));
  });
}

getFetch()
  .then()
  .catch(function (err) {
    console.log(err);
  });

// ////////// 사용 예제
async function updateLinkList() {
  let tag = '';
  const data = await getFetch('./api/getLinkList.php');

  data.response.result.map((item) => {
    tag += `<div class="card">`;
    tag += `<div class="image-content">`;
    tag += `<span class="overlay"></span>`;
    tag += `<div class="card-image">`;
    tag += `<img class="card-img" src="./uploads/${item.img}" alt="" />`;
    tag += `</div>`;
    tag += `</div>`;
    tag += `<div class="card-content">`;
    tag += `<h2 class="name">${item.siteName}</h2>`;
    tag += `<p class="description">${item.category}</p>`;
    tag += `<button class="button" onclick="openSite('${item.linkUrl}')">Visit</button>`;
    tag += `</div>`;
    tag += `</div>`;
  });

  container.innerHTML = tag;
}

// ////////// 사용 예제2
async function updateCategoryList(url) {
  let tag = '';
  let optionTag = `<option value='0'>== 전체 ==</option>`;
  const data = await getFetch(url);

  data.response.result.map((item) => {
    tag += '<tr>';
    tag += `<td>${item.categoryName}</td>`;
    tag += `<td class='center'>`;
    tag += `<button class='btn-mini btn-red' onclick="modifyCategoryList(${item.uid}, '${item.categoryName}')">수정</button>`;
    tag += `<button class='btn-mini btn-black' onclick="deleteCategoryList(${item.uid})">삭제</button>`;
    tag += `</td>`;
    tag += '</tr>';

    optionTag += `<option value='${item.categoryName}'>${item.categoryName}</option>`;
  });

  document.querySelector('#categoryListTable tbody').innerHTML = tag;
  categoryList.forEach((item) => {
    item.innerHTML = optionTag;
  });
}
