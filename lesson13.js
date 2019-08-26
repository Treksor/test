var name = 'Igor',
    age = '28';
console.log('Меня зовут '+name+'.');
console.log('Мне '+age+' лет.');

var test={
    name:'igor',
    age:'28'
}
console.log(test);
delete test.name;
console.log(test);

const town='Novosibirsk';
if (town!==undefined){
    console.log(town);
}
// town='jopa';

var book={};
book.title='пирожок с ничем';
book.autor='Соловьев';
book.pages=10;
console.log('Я прочитал книгу '+book.title+', наипсанную автором '+book.autor+'. Я осилил все '+book.pages+' страниц.');

var book1={};
book1.title='DTF';
book1.autor='Людишки';
book1.pages=9999;
var books=[book,book1];
console.log('Я прочитал книги'+books[0].title+', '+books[1].title+', написанные авторами соответственно '+books[0].autor+' и '+books[1].autor+'Я осилил в сумме '+books[0].pages+books[1].pages+'.');

