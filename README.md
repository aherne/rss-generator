# PHP RSS Feed Generator API

Very light weight PHP API encapsulating entire [RSS-2](https://validator.w3.org/feed/docs/rss2.html) specification, the worldwide standard at this moment for generating RSS feeds.

API only requires PHP 8.1+ and comes with a class for each RSS tag, all belonging to Lucinda\RSS namespace, each implementing [Tag](#Tag) interface. Following are factually mandatory:

| Class | Description |
| --- | --- |
| [RSS](#rss) | Encapsulates [**rss**](https://www.rssboard.org/rss-profile#element-rss) tag, the grand holder of your RSS feed |
| [Channel](#channel) | Encapsulates [**channel**](https://www.rssboard.org/rss-profile#element-channel) tag, child of [**rss**](https://www.rssboard.org/rss-profile#element-rss), containing your RSS feed description |
| [Item](#item) | Encapsulates [**item**](https://www.rssboard.org/rss-profile#element-channel-item) tag, child of [**channel**](https://www.rssboard.org/rss-profile#element-channel), containing an article in your RSS feed |

Simple example:

```php
$channel = new \Lucinda\RSS\Channel("Lucinda Framework", "https://www.lucinda-framework.com", "Current headlines from Lucinda Framework");
$channel->addItem(new \Lucinda\RSS\Item("STDOUT MVC API", "STDOUT MVC API was upgraded to a new version"));
$channel->addItem(new \Lucinda\RSS\Item("STDERR MVC API", "STDERR MVC API was upgraded to a new version"));
$rss = new \Lucinda\RSS\RSS($channel);
echo $rss; // displays RSS feed
```

API enjoys 100% unit test coverage for its classes and methods, reproductible in console by running:

```console
composer update
php test.php
```

*NOTICE*: since superglobal *__toString* is not unit testable, unit tests were done on *toString* method instead!

## RSS<a href="rss"></a>

Class [RSS](https://github.com/aherne/rss-generator/blob/master/src/RSS.php) encapsulates [**rss**](https://www.rssboard.org/rss-profile#element-rss) tag logic via following void returning methods:

| Method | Arguments | Description |
| --- | --- | --- |
| __construct | [Channel](#channel) $channel | Constructs feed based on mandatory RSS **channel** |
| addNamespace | string $name<br/>string $url | Adds a RSS namespace able to add custom functionality to feed |

To understand more how namespaces can be used to add non-standard tags to feed, visit [this guide](https://www.rssboard.org/rss-profile#namespace-elements)!

## Channel<a href="channel"></a>

Class [Channel](https://github.com/aherne/rss-generator/blob/master/src/Channel.php) encapsulates [**channel**](https://www.rssboard.org/rss-profile#element-channel) tag logic via following void returning methods:

| Method | Arguments | Description |
| --- | --- | --- |
| __construct | string $title<br/>string $link<br/>string $description | Sets values of required sub-tags: [**title**](https://www.rssboard.org/rss-profile#element-channel-title), [**link**](https://www.rssboard.org/rss-profile#element-channel-link), [**description**](https://www.rssboard.org/rss-profile#element-channel-description) [1] |
| addItem | [Item](#item) $item | Sets value of sub-tag [**item**](https://www.rssboard.org/rss-profile#element-channel-item) |
| setLanguage | string $language | Sets value of sub-tag [**language**](https://www.rssboard.org/rss-profile#element-channel-language) |
| setCopyright | string $copyright | Sets value of sub-tag [**copyright**](https://www.rssboard.org/rss-profile#element-channel-copyright) |
| setManagingEditor | string $email | Sets value of sub-tag [**managingEditor**](https://www.rssboard.org/rss-profile#element-channel-managingeditor) |
| setWebMaster | string $email | Sets value of sub-tag [**webMaster**](https://www.rssboard.org/rss-profile#element-channel-webmaster) |
| setPubDate | int $unixTime | Sets value of sub-tag [**pubDate**](https://www.rssboard.org/rss-profile#element-channel-pubdate) by corresponding unix time |
| setLastBuildDate | int $unixTime | Sets value of sub-tag [**lastBuildDate**](https://www.rssboard.org/rss-profile#element-channel-lastbuilddate) by corresponding unix time |
| setCategory | string $category | Sets value of sub-tag [**category**](https://www.rssboard.org/rss-profile#element-channel-category) |
| setGenerator | string $generator | Sets value of sub-tag [**generator**](https://www.rssboard.org/rss-profile#element-channel-generator) |
| setDocs | string $url | Sets value of sub-tag [**docs**](https://www.rssboard.org/rss-profile#element-channel-docs) |
| setCloud | [Cloud](https://github.com/aherne/rss-generator/blob/master/src/Cloud.php) $cloud | Sets value of sub-tag [**cloud**](https://www.rssboard.org/rss-profile#element-channel-cloud) |
| setTtl | int $number | Sets value of sub-tag [**ttl**](https://www.rssboard.org/rss-profile#element-channel-ttl) |
| setImage | [Image](https://github.com/aherne/rss-generator/blob/master/src/Image.php) $image | Sets value of sub-tag [**image**](https://www.rssboard.org/rss-profile#element-channel-image) |
| setTextInput | [Input](https://github.com/aherne/rss-generator/blob/master/src/Input.php) $textInput | Sets value of sub-tag [**textInput**](https://www.rssboard.org/rss-profile#element-channel-textinput) |
| setSkipHours | [SkipHours](https://github.com/aherne/rss-generator/blob/master/src/SkipHours.php) $skipHours | Sets value of sub-tag [**skipHours**](https://www.rssboard.org/rss-profile#element-channel-skiphours) |
| setSkipDays | [SkipDays](https://github.com/aherne/rss-generator/blob/master/src/SkipDays.php) $skipDays | Sets value of sub-tag [**skipDays**](https://www.rssboard.org/rss-profile#element-channel-skipdays) |
| addCustomTag | [Tag](#Tag) $tag | Adds custom non-standard sub-tag |

[1] Value of $description is automatically escaped using CDATA via [Escape](#escape) class, in order to make it possible to put HTML inside

## Item<a href="item"></a>

Class [Item](https://github.com/aherne/rss-generator/blob/master/src/Item.php) encapsulates [**item**](https://www.rssboard.org/rss-profile#element-channel-item) tag logic via following void returning methods:

| Method | Arguments | Specification |
| --- | --- | --- |
| __construct | string $title<br/>string $description | Sets values of required sub-tags: [**title**](https://www.rssboard.org/rss-profile#element-channel-item-title), [**description**](https://www.rssboard.org/rss-profile#element-channel-item-description) [1] |
| setLink | string $url | Sets value of sub-tag [**link**](https://www.rssboard.org/rss-profile#element-channel-item-link) |
| setAuthor | string $email | Sets value of sub-tag [**author**](https://www.rssboard.org/rss-profile#element-channel-item-author) |
| setCategories | string $category | Sets value of sub-tag [**categories**](https://www.rssboard.org/rss-profile#element-channel-item-categories) |
| setComments | string $url | Sets value of sub-tag [**comments**](https://www.rssboard.org/rss-profile#element-channel-item-comments) |
| setEnclosure | [Enclosure](https://github.com/aherne/rss-generator/blob/master/src/Enclosure.php) $enclosure | Sets value of sub-tag [**enclosure**](https://www.rssboard.org/rss-profile#element-channel-item-enclosure) |
| setGuid | string $guid | Sets value of sub-tag [**guid**](https://www.rssboard.org/rss-profile#element-channel-item-guid) |
| setPubDate | int $unixTime | Sets value of sub-tag [**pubDate**](https://www.rssboard.org/rss-profile#element-channel-item-pubdate) by corresponding unix time |
| setSource | string $url | Sets value of sub-tag [**source**](https://www.rssboard.org/rss-profile#element-channel-item-source) |
| addCustomTag | [Tag](#Tag) $tag | Adds custom non-standard sub-tag |

[1] Value of $description is automatically escaped using CDATA via [Escape](#escape) class, in order to make it possible to put HTML inside

## Tag<a href="tag"></a>

Interface [Tag](https://github.com/aherne/rss-generator/blob/master/src/Tag.php) defines common ability of all RSS tags to be [\Stringable](https://www.php.net/manual/en/class.stringable.php)

## Escape<a href="escape"></a>

Class [Escape](https://github.com/aherne/rss-generator/blob/master/src/Escape.php) envelopes a value using CDATA via following method inherited from [Tag](#tag):

| Method | Arguments | Returns |
| --- | --- | --- |
| __toString | - | string |