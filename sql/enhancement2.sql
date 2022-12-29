insert into clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
    VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real iron man');

update clients 
    set clientLevel = 3
    where clientEmail = 'tony@starkent.com';

update inventory
    set invDescription = replace(invDescription, 'small', 'spacious')
    where invModel = 'hummer';

select inventory.invModel, carclassification.classificationName
    from inventory 
    inner JOIN carclassification on inventory.classificationId = carclassification.classificationId
    where carclassification.classificationName = 'suv';

delete from inventory where invMake = 'jeep' and invModel = 'wrangler';

update inventory
    set invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail)