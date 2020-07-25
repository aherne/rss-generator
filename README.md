# PHP RSS Feed Generator API

Very light weight PHP API encapsulating entire [RSS-2](https://validator.w3.org/feed/docs/rss2.html) specification, the worldwide standard at this moment for generating RSS feeds.

API requires PHP7.1+ and comes with a class for each RSS tag, all belonging to Lucinda\RSS namespace, each implementing [Tag](#Tag) interface. Following are factually mandatory:

| Class | Description |
| --- | --- |
| [RSS](#rss) | Encapsulates *rss* tag, the grand holder of your RSS feed |
| [Channel](#channel) | Encapsulates *channel* tag, child of *rss*, containing your RSS feed description |
| [Item](#item) | Encapsulates *item* tag, child of *channel*, containing an article in your RSS feed |

Simple example:

```php
$channel = new \Lucinda\RSS\Channel("Lucinda Framework", "https://www.lucinda-framework.com", "Current headlines from Lucinda Framework");
$channel->addItem(new \Lucinda\RSS\Item("STDOUT MVC API", "STDOUT MVC API was upgraded to a new version"));
$channel->addItem(new \Lucinda\RSS\Item("STDERR MVC API", "STDERR MVC API was upgraded to a new version"));
$rss = new \Lucinda\RSS\RSS($channel);
echo $rss; // displays RSS feed
```

## RSS<a href="rss"></a>

Class [RSS](https://github.com/aherne/rss-generator/blob/master/src/RSS.php) encapsulates **rss** tag logic via following void returning methods:

| Method | Arguments | Description |
| --- | --- | --- |
| __construct | [Channel](#channel) $channel | Constructs feed based on mandatory RSS **channel** |
| addNamespace | string $name<br/>string $url | Adds a RSS namespace able to add custom functionality to feed |

## Channel<a href="channel"></a>

Class [Channel](https://github.com/aherne/rss-generator/blob/master/src/Channel.php) encapsulates **channel** tag logic via following void returning methods:

| Method | Arguments | Description |
| --- | --- | --- |
| __construct | string $title<br/>string $link<br/>string $description | Sets values of required sub-tags: **title**, **link**, **description**[1] |
| addItem | [Item](#item) $item | Sets value of sub-tag **item** |
| setLanguage | string $language | Sets value of sub-tag **language** |
| setCopyright | string $copyright | Sets value of sub-tag **copyright** |
| setManagingEditor | string $email | Sets value of sub-tag **managingEditor** |
| setWebMaster | string $email | Sets value of sub-tag **webMaster** |
| setPubDate | int $unixTime | Sets value of sub-tag **pubDate** by corresponding unix time |
| setLastBuildDate | int $unixTime | Sets value of sub-tag **lastBuildDate** by corresponding unix time |
| setCategory | string $category | Sets value of sub-tag **category** |
| setGenerator | string $generator | Sets value of sub-tag **generator** |
| setDocs | string $url | Sets value of sub-tag **docs** |
| setCloud | [Cloud](https://github.com/aherne/rss-generator/blob/master/src/Cloud.php) $cloud | Sets value of sub-tag **cloud** |
| setTtl | int $number | Sets value of sub-tag **ttl** |
| setImage | [Image](https://github.com/aherne/rss-generator/blob/master/src/Image.php) $image | Sets value of sub-tag **image** |
| setTextInput | [Input](https://github.com/aherne/rss-generator/blob/master/src/Input.php) $textInput | Sets value of sub-tag **textInput** |
| setSkipHours | [SkipHours](https://github.com/aherne/rss-generator/blob/master/src/SkipHours.php) $skipHours | Sets value of sub-tag **skipHours** |
| setSkipDays | [SkipDays](https://github.com/aherne/rss-generator/blob/master/src/SkipDays.php) $skipDays | Sets value of sub-tag **skipDays** |
| addCustomTag | [Tag](#Tag) $tag | Adds custom non-standard sub-tag |

[1] Value of $description is automatically escaped using CDATA via [Escape](#escape) class, in order to allow HTML inside

## Item<a href="item"></a>

Class [Item](https://github.com/aherne/rss-generator/blob/master/src/Item.php) encapsulates **item** tag logic via following void returning methods:

| Method | Arguments | Specification |
| --- | --- | --- |
| __construct | string $title<br/>string $description | Sets values of required sub-tags: **title**, **description**[1] |
| setLink | string $url | Sets value of sub-tag **link** |
| setAuthor | string $email | Sets value of sub-tag **author** |
| setCategories | string $category | Sets value of sub-tag **categories** |
| setComments | string $url | Sets value of sub-tag **comments** |
| setEnclosure | [Enclosure](https://github.com/aherne/rss-generator/blob/master/src/Enclosure.php) $enclosure | Sets value of sub-tag **enclosure** |
| setGuid | string $guid | Sets value of sub-tag **guid** |
| setPubDate | int $unixTime | Sets value of sub-tag **pubDate** by corresponding unix time |
| setSource | string $url | Sets value of sub-tag **source** |
| addCustomTag | [Tag](#Tag) $tag | Adds custom non-standard sub-tag |

[1] Value of $description is automatically escaped using CDATA via [Escape](#escape) class, in order to allow HTML inside

## Tag<a href="tag"></a>

Interface [Tag](https://github.com/aherne/rss-generator/blob/master/src/Tag.php) defines common ability of all RSS tags to be stringified via following method:

| Method | Arguments | Returns |
| --- | --- | --- |
| __toString | - | string |

## Escape<a href="escape"></a>

Class [Escape](https://github.com/aherne/rss-generator/blob/master/src/Escape.php) envelopes a value using CDATA via following method inherited from [Tag](#tag):

| Method | Arguments | Returns |
| --- | --- | --- |
| __toString | - | string |