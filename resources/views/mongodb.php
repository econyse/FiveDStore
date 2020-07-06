<?php

// $collection = (new MongoDB\Client)->FiveDStore->Users;

// $cursor = $collection->find([], [ 'limit' => 10 ]);

// foreach ($cursor as $document) {
//         echo '<br />';

//     print_r($document);
//     echo '<br />';
// }

// // Create Function
// $collection = (new MongoDB\Client)->FiveDStore->Categories;

// $insertResult = $collection->insertOne([
//     'category' => 'Cellphones',
//     'description' => 'Smart phones for on the go use.'
// ]);

// printf('Inserted %d document(s)<br />', $insertResult->getInsertedCount());

// var_dump($insertResult->getInsertedID());

// Read Function
// echo '<br />';
// $table = $collection->find();

// foreach($table as $record) {
//     echo "ID: ".$record["_id"]."<br />";
//     echo "Category: ".$record["category"]."<br />";
//     echo "Description: ".$record["description"]."<br />";
//     echo '<br />';
//     echo '<br />';
// }

// Update function
// $updateResult = $collection->updateOne([
//     "category" => "Cellphones"
// ],
// [
//     '$set' => [ "description" => "Mobile phones." ]
// ]);

// printf("Matched %d document(s)<br />", $updateResult->getMatchedCount());
// printf("Modified %d document(s)<br />", $updateResult->getModifiedCount());

// Delete Function
// $deleteResult = $collection->deleteOne([
//     "_id" => 'ObjectID("5ef35126867b000008007829")'
// ]);

// printf("Deleted %d document(s)<br />", $deleteResult->getDeletedCount());

// $collection = (new MongoDB\Client)->FiveDStore->Products;
// $productCount = $collection->count([ "category_id" => "1234" ]);

// print_r($productCount);

$collection = (new MongoDB\Client)->FiveDStore->Products;
$comment = [
    "user_id" => "5ee0d5fcb580f72af8e60eb2",
    "comment" => "Great smartwatch",
    "date" => "2020-07-01 08:22:00.000"
];
$product = $collection->findOne([ "_id" => new MongoDB\BSON\ObjectId("5ee3be565a59d3057882e3ec") ]);
$comments = $product->comments;
if (count($comments) == 0) {
    $comments = [$comment];
} else {
    $comments = [$comment, ...$comments];
}
$updateOneResult = $collection->updateOne([
    "_id" => new MongoDB\BSON\ObjectId("5ee3be565a59d3057882e3ec")
],[
    '$set' => [ 'comments' => $comments ]
]);