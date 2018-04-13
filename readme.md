### A Handesk PHP sdk 

Check the full project at [https://github.com/BadChoice/handesk](https://github.com/BadChoice/handesk)

#### Usage 
##### Tickets
To get the open tickets for a requester (it only returns the ticket header, see find below to get the full ticket) 

```
$tickets = (new Ticket)->get('requesterNameOrEmail');
```

You can ask for the closed, or solved adding a second parameter

```
$solvedTickets = (new Ticket)->get('requesterNameOrEmail','solved');
$openTickets = (new Ticket)->get('requesterNameOrEmail','solved');
```

You can create new tickets as well

```
$ticket_id = (new Ticket)->create(
    ["name" => "Requester name", "email" => "requester@email.com"], 
    "The ticket subject", 
    "The ticket initial body", 
    ["tag1","tag2"]
   );
```

And then fetch a ticket

```
$ticket = (new Ticket)->find($id);
$comments = $ticket->comments; //Includes the initial comment
$comments->first()->requester; // ["name" => "Requester name", "email" => "Requester email"]
```

Adding comments to tickets
```
$ticket->addComment("Adding a comment");
$ticket->addComment("Adding a comment and solving the ticket", true);
```

##### Teams
```
    (new Team(2))->tickets();           //gets all open tickets for team with id 2
    (new Team(2))->tickets('solved');   //gets all solved tickets for team with id 2
    (new Team(2))->ticketsCount();      //gets the count of all open tickets for team with id 2
    (new Team(2))->ticketsCount('closed'); //gets the count of all closed tickets for team with id 2
```



##### Leads

To create a lead simply call:
```
$id = (new Lead)->create([
            "email"       => "bruce@wayne.com",
            "body"        => "I'm interested in buying this awesome app",
            "username"    => "brucewayne",
            "name"        => "Bruce Wayne",
            "phone"       => "0044 456 567 54",
            "address"     => "Wayne manner",
            "city"        => "Gotham",
            "postal_code" => "90872",
            "company"     => "Wayne enterprises"]
            ,
            ["lightning","handesk"]
        );
```
> Only `name` is a required field

#### Development
PRs welcome